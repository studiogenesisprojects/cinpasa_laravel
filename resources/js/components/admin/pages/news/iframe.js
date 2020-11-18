import { Node } from 'tiptap'

export default class Iframe extends Node {

    get name() {
        return 'iframe'
    }

    get schema() {
        return {
            attrs: {
                src: {
                    default: null,
                },
            },
            group: 'block',
            selectable: false,
            draggable: true,
            parseDOM: [{
                tag: 'iframe',
                getAttrs: dom => ({
                    src: 'https://www.youtube.com/embed/' + dom.getAttribute('src'),
                }),
            }],
            toDOM: node => ['iframe', {
                src: 'https://www.youtube.com/embed/' + node.attrs.src,
                frameborder: 0,
                allowfullscreen: 'true',
            }],
        }
    }

    commands({ type }) {
        return attrs => (state, dispatch) => {
            const { selection } = state
            const position = selection.$cursor ? selection.$cursor.pos : selection.$to.pos
            const node = type.create(attrs)
            const transaction = state.tr.insert(position, node)
            dispatch(transaction)
        }
    }

    get view() {
        return {
            props: ['node', 'updateAttrs', 'view'],
            computed: {
                src: {
                    get() {
                        return this.node.attrs.src
                    },
                    set(src) {
                        this.updateAttrs({
                            src,
                        })
                    },
                },
            },
            template: `
        <div class="iframe">
          <iframe class="iframe__embed" width="100%" height="320px" :src="'https://www.youtube.com/embed/'+src"></iframe>
        </div>
      `,
        }
    }

}