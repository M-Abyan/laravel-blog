<script setup>
    import BoldIcon from 'vue-material-design-icons/FormatBold.vue';
    import ItalicIcon from 'vue-material-design-icons/FormatItalic.vue';
    import UnderlineIcon from 'vue-material-design-icons/FormatUnderline.vue';
    import ParagraphIcon from 'vue-material-design-icons/FormatParagraph.vue';
    import UnorderedList from 'vue-material-design-icons/FormatListBulleted.vue';
    import OrderedList from 'vue-material-design-icons/FormatLIstNumbered.vue';
    import H1Icon from 'vue-material-design-icons/FormatHeader1.vue';
    import H2Icon from 'vue-material-design-icons/FormatHeader2.vue';
    import H3Icon from 'vue-material-design-icons/FormatHeader3.vue';
    import CodeIcon from 'vue-material-design-icons/Xml.vue';
    import QuoteIcon from 'vue-material-design-icons/FormatQuoteOpen.vue';
    import ClearIcon from 'vue-material-design-icons/FormatClear.vue';
    import UndoIcon from 'vue-material-design-icons/UndoVariant.vue';
    import RedoIcon from 'vue-material-design-icons/RedoVariant.vue';
    import { useEditor, EditorContent } from '@tiptap/vue-3'
    import Underline from '@tiptap/extension-underline'
    import StarterKit from '@tiptap/starter-kit'

    const props = defineProps({
        modelValue: String
    })

    const emit = defineEmits(['update:modelValue'])

    const editor = useEditor({
        editorProps: {
            attributes: {
                class: 'p-4 border-secondary border-[3px] prose max-w-none max-h-[15rem] min-h-[15rem] overflow-y-auto  outline-none rounded-b-sm',
            },
        },
        content: props.modelValue,
        onUpdate: ({editor}) => {
            emit('update:modelValue', editor.getHTML())
        },
        extensions: [
            StarterKit,
            Underline,
        ],
    })
</script>

<template>
    <div class="flex flex-col shadow-[6px_6px] rounded-md">
        <div v-if="editor" class="flex gap-2 flex-wrap items-center border-t-[3px] border-x-[3px] border-secondary py-2 rounded-t-md px-4">
            <button type="button" @click="editor.chain().focus().toggleUnderline().run()" :class="{ 'is-active': editor.isActive('underline') }">
                <UnderlineIcon/>
            </button>
            <button type="button" @click="editor.chain().focus().toggleBold().run()" :disabled="!editor.can().chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">
                <BoldIcon />
            </button>
            <button type="button" @click="editor.chain().focus().toggleItalic().run()" :disabled="!editor.can().chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
                <ItalicIcon />
            </button>
            <button type="button" @click="editor.chain().focus().clearNodes().run()">
                <ClearIcon/>
            </button>
            <button type="button" @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">
                <ParagraphIcon/>
            </button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
                <H1Icon/>
            </button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
                <H2Icon/>
            </button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
                <H3Icon/>
            </button>
            <button type="button" @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
                <UnorderedList/>
            </button>
            <button type="button" @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
                <OrderedList/>
            </button>
            <button type="button" @click="editor.chain().focus().toggleCodeBlock().run()" :class="{ 'is-active': editor.isActive('codeBlock') }">
                <CodeIcon/>
            </button>
            <button type="button" @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">
                <QuoteIcon/>
            </button>
            <button type="button" @click="editor.chain().focus().undo().run()" :disabled="!editor.can().chain().focus().undo().run()">
                <UndoIcon/>
            </button>
            <button type="button" @click="editor.chain().focus().redo().run()" :disabled="!editor.can().chain().focus().redo().run()">
                <RedoIcon/>
            </button>
        </div>
        <editor-content :editor="editor"/>
    </div>
</template>