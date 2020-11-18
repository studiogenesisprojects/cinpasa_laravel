<?php

namespace App\Http\Controllers\Back\SecondaryImages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SecondaryImageRequest;
use App\Models\SecondaryImageSection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SecondaryImages extends Controller
{
    public function index()
    {
        $secondaryImages = SecondaryImageSection::cursor();
        return view('back.products.secondaryImages.index', compact('secondaryImages'));
    }

    public function update($id = null)
    {
        if ($id) {
            $secondaryImage = SecondaryImageSection::find($id);
        } else {
            $secondaryImage = new SecondaryImageSection;
        }

        return view('back.products.secondaryImages.update', compact('secondaryImage'));
    }

    public function handleUpdate(SecondaryImageRequest $request, $id = null)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $image = $request->image;

                $imageName = sha1(time() . Str::random(4)) . '.' . $image->getClientOriginalExtension();
                $image_path = config('app.route_uploads.secondary_images_sections');

                $image->storeAs($image_path, $imageName, 'public_uploads');
            } else {
                $image = SecondaryImageSection::findOrFail($id);

                $imageName = $image->image;
            }

            if ($id) {
                $secondaryImage = SecondaryImageSection::findOrFail($id);
                if ($request->hasFile('image')) {
                    $file = public_path() . DIRECTORY_SEPARATOR . config('app.route_uploads.secondary_images_sections_delete') . DIRECTORY_SEPARATOR . $secondaryImage->image;

                    if (\File::exists($file)) {
                        \File::delete($file);
                    }
                }
                $secondaryImage->update([
                    'name' => $request->name,
                    'text' => $request->text,
                    'image' => $imageName
                ]);
            } else {
                $secondaryImage = SecondaryImageSection::create([
                    'name' => $request->name,
                    'text' => $request->text,
                    'image' => $imageName
                ]);
            }
            DB::commit();

            return redirect()->route('secondaryImagesUpdate', $secondaryImage->id);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->route('secondaryImagesUpdate')->with('message', 'No se ha podido realizar la acción.');
        }
    }

    // public function delete($id)
    // {
    //     try {

    //         DB::beginTransaction();
    //         $secondaryImage = SecondaryImageSection::findOrFail($id);

    //         $secondaryImage->delete();

    //         DB::commit();

    //         return redirect()->route('secondaryImageIndex');
    //     } catch (Exception $e) {

    //         DB::rollback();
    //         Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
    //         return redirect()->route('secondaryImageIndex')->with('message', 'No se ha podido realizar la acción.');
    //     }
    // }
}
