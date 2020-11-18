<template>
  <div class="richeditor">
    <div class="pb-3">
      <strong>Contenido</strong>
    </div>
    <editor-menu-bar :editor="editor" v-slot="{commands, isActive}">
      <div class="richeditor__menu">
        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.bold() }"
          @click="commands.bold"
        >
          <i class="fas fa-bold"></i>
        </a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.italic() }"
          @click="commands.italic"
        >
          <i class="fas fa-italic"></i>
        </a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.strike() }"
          @click="commands.strike"
        >
          <i class="fas fa-strikethrough"></i>
        </a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.underline() }"
          @click="commands.underline"
        >
          <i class="fas fa-underline"></i>
        </a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.paragraph() }"
          @click="commands.paragraph"
        >
          <i class="fas fa-paragraph"></i>
        </a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 1 }) }"
          @click="commands.heading({ level: 1 })"
        >H1</a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 2 }) }"
          @click="commands.heading({ level: 2 })"
        >H2</a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 3 }) }"
          @click="commands.heading({ level: 3 })"
        >H3</a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.bullet_list() }"
          @click="commands.bullet_list"
        >
          <i class="fas fa-list-ol"></i>
        </a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.ordered_list() }"
          @click="commands.ordered_list"
        >
          <i class="fas fa-list-ul"></i>
        </a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          :class="{ 'is-active': isActive.blockquote() }"
          @click="commands.blockquote"
        >
          <i class="fas fa-quote-right"></i>
        </a-button>

        <a-button
          shape="round"
          size="small"
          class="menubar__button"
          @click="commands.horizontal_rule"
        >__</a-button>

        <a-button shape="round" size="small" class="menubar__button" @click="commands.undo">
          <i class="fas fa-undo"></i>
        </a-button>

        <a-button shape="round" size="small" class="menubar__button" @click="commands.redo">
          <i class="fas fa-redo"></i>
        </a-button>
        <a-button shape="round" size="small" class="menubar__button" @click="showImageModal = true">
          <i class="fas fa-image"></i>
        </a-button>
        <a-button shape="round" size="small" class="menubar__button" @click="showVideoModal = true">
          <i class="fas fa-video"></i>
        </a-button>
      </div>
    </editor-menu-bar>
    <editor-menu-bubble
      class="menububble"
      :editor="editor"
      @hide="hideLinkMenu"
      v-slot="{ commands, isActive, getMarkAttrs, menu }"
    >
      <div
        class="menububble"
        :class="{ 'is-active': menu.isActive }"
        :style="`left: ${menu.left}px; bottom: ${menu.bottom}px;`"
      >
        <form
          class="menububble__form"
          v-if="linkMenuIsActive"
          @submit.prevent="setLinkUrl(commands.link, linkUrl)"
        >
          <a-input
            type="text"
            v-model="linkUrl"
            placeholder="Introduzca la url..."
            ref="linkInput"
            @keydown.esc="hideLinkMenu"
          >
            <a-icon slot="addonAfter" type="close" @click="setLinkUrl(commands.link, null)" />
          </a-input>
        </form>

        <template v-else>
          <a-button
            icon="link"
            type="link"
            size="small"
            class="text-white"
            @click="showLinkMenu(getMarkAttrs('link'))"
            :class="{ 'is-active': isActive.link() }"
          >
            <span>{{ isActive.link() ? 'Actualizar' : 'Añadir'}} link</span>
          </a-button>
        </template>
        <a-modal
          @ok="handleOk(commands)"
          :visible="showImageModal"
          @cancel="showImageModal = false"
        >
          <div class="form-group">
            <template>
              <a-upload :showUploadList="false" :customRequest="handleUpload">
                <a-button v-if="image.src === undefined">
                  <a-icon type="upload" />Click para subir un archivo
                </a-button>
                <a-alert
                  type="success"
                  message="Imagen subida correctamente, completa los campos y pulsa OK"
                  v-else
                ></a-alert>
              </a-upload>
            </template>
          </div>
          <div class="form-group">
            <label>Título</label>
            <input
              type="text"
              class="form-control"
              placeholder="Título de la imagen"
              v-model="image.title"
            />
          </div>
          <div class="form-group">
            <label>Etiqueta alt</label>
            <input type="text" class="form-control" v-model="image.alt" />
          </div>
        </a-modal>
        <a-modal
          @ok="handleVideoOk(commands)"
          :visible="showVideoModal"
          @cancel="showVideoModal = false"
        >
          <div class="form-group">
            <label>Link del video</label>
            <input
              type="text"
              class="form-control"
              placeholder="Link del video"
              v-model="video.link"
            />
          </div>
        </a-modal>
      </div>
    </editor-menu-bubble>

    <editor-content class="richeditor__content" :editor="editor" />
  </div>
</template>
<script>
import { Editor, EditorContent, EditorMenuBar, EditorMenuBubble } from "tiptap";
import {
  Blockquote,
  HardBreak,
  Heading,
  OrderedList,
  HorizontalRule,
  BulletList,
  ListItem,
  Bold,
  Italic,
  Link,
  Image,
  Strike,
  Underline,
  History,
  Focus
} from "tiptap-extensions";
import Iframe from "./iframe";
export default {
  name: "rich-editor",
  props: ["text"],
  components: { EditorMenuBar, EditorContent, EditorMenuBubble },
  data() {
    return {
      image: {},
      video: {},
      fileList: [],
      showImageModal: false,
      showCarrouselModal: false,
      showVideoModal: false,
      editor: new Editor({
        content: this.text,
        autoFocus: true,
        extensions: [
          new Blockquote(),
          new HardBreak(),
          new Heading({ levels: [1, 2, 3] }),
          new BulletList(),
          new OrderedList(),
          new HorizontalRule(),
          new ListItem(),
          new Bold(),
          new Italic(),
          new Link(),
          new Strike(),
          new Underline(),
          new History(),
          new Image(),
          new Iframe()
        ],
        onUpdate: p => {
          this.$emit("onContentChange", p.getHTML());
        }
      }),
      linkUrl: null,
      linkMenuIsActive: false
    };
  },
  methods: {
    showLinkMenu(attrs) {
      this.linkUrl = attrs.href;
      this.linkMenuIsActive = true;
      this.$nextTick(() => {
        this.$refs.linkInput.focus();
      });
    },
    hideLinkMenu() {
      this.linkUrl = null;
      this.linkMenuIsActive = false;
    },
    setLinkUrl(command, url) {
      command({ href: url });
      this.hideLinkMenu();
    },
    handleUpload({ onSuccess, onError, file }) {
      const url = "/admin/news/images";
      const formData = new FormData();
      formData.append("image", file);
      axios
        .post(url, formData)
        .then(r => {
          this.$set(this.image, "src", r.data);
          onSuccess();
        })
        .catch(e => {
          console.log(e.response);
          onError();
        });
      return true;
    },
    handleOk(commands) {
      if (this.image.src) {
        commands.image(this.image);
        this.image = {};
        this.showImageModal = false;
      } else {
        this.$message.error("No olvides subir una imagen");
      }
    },
    handleVideoOk(commands) {
      if (this.video.link && this.video.link.length > 5) {
        commands.iframe({ src: this.video.link });
        this.showVideoModal = false;
      } else {
        this.$message.error("Intoduce un link válido");
      }
    }
  }
};
</script>
<style>
.richeditor {
  background: white;
  margin: 1em 0;
}
.richeditor__menu {
  padding-bottom: 2em;
}
.richeditor__content {
  border: 2px solid #dde2ec;
  padding: 3em 1em;
  border-radius: 4px;
}
.ProseMirror:focus {
  outline: none;
}
.menububble.menububble.is-active {
  opacity: 1;
  visibility: visible;
}

blockquote {
  padding-left: 1em;
  border-left: 4px solid gray;
}

.menububble.menububble {
  position: absolute;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  z-index: 20;
  background: #000;
  border-radius: 5px;
  padding: 0.3rem;
  margin-bottom: 0.5rem;
  -webkit-transform: translateX(-50%);
  transform: translateX(-50%);
  visibility: hidden;
  opacity: 0;
  -webkit-transition: opacity 0.2s, visibility 0.2s;
  transition: opacity 0.2s, visibility 0.2s;
}
button.menubar__button.ant-btn.ant-btn-round.ant-btn-sm {
  margin-top: 0.75em;
}
button.menubar__button.ant-btn.ant-btn-round.ant-btn-sm.is-active {
  background: #2b3b78;
  color: white;
}
img {
  width: 100%;
}
</style>