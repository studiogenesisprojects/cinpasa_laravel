<div class="searcher-menu">
    <form action="{{route('searcher')}}" method="GET" id="searcher">
      <div class="bg-primary p-4">
        <div class="row searcher-menu__row">
          <div class="col-12">
            <div class="d-flex align-items-center mb-3 searcher-menu__trigger">
              <p class="text-white title-sm m-0">{{__('Buscador.titulo1')}}</p>
              <div class="ml-auto">
                <span
                  class="text-white w-light underline"
                  data-toggle="collapse"
                  data-target="#searcher-collapse"
                  aria-expanded="false"
                  aria-controls="searcher-collapse"
                >
                {{__('Buscador.avanzado')}}
                  <i class="fas fa-angle-down"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-xl-11 col-md-10">
            <div class="row align-items-end">
              <div class="col-lg-3 col-md-6">
                <div class="form-group mb-0">
                  <input type="text" class="form-control" name="name" placeholder="{{__('Buscador.producto_placeholder')}}" value="{{ Request::input('name') }}" />
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="form-group mb-0">
                  <select class="form-control" name="material">
                      <option value>{{__('Buscador.materiales_placeholder')}}</option>
                    @foreach ($materials as $material)
                    <option
                    value="{{ $material["id"] }}"
                    @if(Request::input('material') == $material["id"]) selected @endif
                  >{{ $material['name'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="form-group mb-0">
                  <select class="form-control" name="application">
                    <option value>{{__('Buscador.aplicaciones_placeholder')}}</option>
                    @foreach ($applications as $application)
                    <option value="{{ $application["id"] }}"
                    @if(Request::input('application') == $application["id"]) selected @endif
                    >{{$application['name']}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="form-group mb-0">
                  <select class="form-control" name="shade">
                    <option value>{{__('Buscador.colores_placeholder')}}</option>
                    @foreach ($shades as $shade)
                    <option value="{{ $shade["id"] }}"
                    @if(Request::input('shade') == $shade["id"]) selected @endif
                    >{{$shade['name']}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-1 col-md-2 mt-2 text-right">
            <button type="submit" class="ant-btn ant-btn-primary">
               <i class="fas fa-search mr-1"></i> {{__('Buscador.buscar_boton')}}
            </button>
        </div>
        </div>
      </div>

      <div class="bg-primary p-4 searcher-menu__collapse collapse" id="searcher-collapse">
        <div class="row">
          <div class="col-md-7">
            <div class="form-group">
              <select class="form-control" name="category">
                <option value>{{__('Buscador.tipo_placeholder')}}</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->lang()->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <select class="form-control" name="diameter">
                <option value>{{__('Buscador.diametro_placeholder')}}</option>
                @foreach ($references as $reference)
                  <option value="{{$reference->diametro}}">{{ $reference->diametro }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" name="braid">
                <option value>{{__('Buscador.trenzado_placeholder')}}</option>
                @foreach ($braids as $braid)
                  <option value="{{$braid->id}}">{{ $braid->lang()->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" name="form">
                <option value>{{__('Buscador.forma_placeholder')}}</option>
                @foreach ($forms as $form)
                  <option value="{{$form->id}}">{{ $form->lang()->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" name="ending">
                <option value>{{__('Buscador.acabado_placeholder')}}</option>
                @foreach ($endings as $ending)
                <option value="{{$ending->id}}">{{ $ending->lang()->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>