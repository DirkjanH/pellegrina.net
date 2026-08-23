import { ClassicEditor } from "@ckeditor/ckeditor5-editor-classic"
import { Alignment } from "@ckeditor/ckeditor5-alignment"
import { Autoformat } from "@ckeditor/ckeditor5-autoformat"
import {
	Bold,
	Code,
	Italic,
	Strikethrough,
	Subscript,
	Superscript,
	Underline,
} from "@ckeditor/ckeditor5-basic-styles"
import { BlockQuote } from "@ckeditor/ckeditor5-block-quote"
import { CodeBlock } from "@ckeditor/ckeditor5-code-block"
import { Essentials } from "@ckeditor/ckeditor5-essentials"
import { FindAndReplace } from "@ckeditor/ckeditor5-find-and-replace"
import {
	Font,
	FontBackgroundColor,
	FontColor,
	FontFamily,
	FontSize,
} from "@ckeditor/ckeditor5-font"
import { Heading } from "@ckeditor/ckeditor5-heading"
import { Highlight } from "@ckeditor/ckeditor5-highlight"
import { HorizontalLine } from "@ckeditor/ckeditor5-horizontal-line"
import { HtmlEmbed } from "@ckeditor/ckeditor5-html-embed"
import { GeneralHtmlSupport } from "@ckeditor/ckeditor5-html-support"
import {
	Image,
	ImageCaption,
	ImageInsert,
	ImageStyle,
	ImageToolbar,
} from "@ckeditor/ckeditor5-image"
import { Indent } from "@ckeditor/ckeditor5-indent"
import { Link } from "@ckeditor/ckeditor5-link"
import { List } from "@ckeditor/ckeditor5-list"
import { MediaEmbed } from "@ckeditor/ckeditor5-media-embed"
import { PageBreak } from "@ckeditor/ckeditor5-page-break"
import { Paragraph } from "@ckeditor/ckeditor5-paragraph"
import { PasteFromOffice } from "@ckeditor/ckeditor5-paste-from-office"
import { RemoveFormat } from "@ckeditor/ckeditor5-remove-format"
import { SelectAll } from "@ckeditor/ckeditor5-select-all"
import { SourceEditing } from "@ckeditor/ckeditor5-source-editing"
import {
	SpecialCharacters,
	SpecialCharactersEssentials,
} from "@ckeditor/ckeditor5-special-characters"
import { Style } from "@ckeditor/ckeditor5-style"
import { Table, TableToolbar } from "@ckeditor/ckeditor5-table"
import { Undo } from "@ckeditor/ckeditor5-undo"
import "@ckeditor/ckeditor5-theme-lark/theme/theme.css"
import "@ckeditor/ckeditor5-core/dist/translations/nl.js"

class MailingEditor extends ClassicEditor {}

MailingEditor.builtinPlugins = [
	Alignment,
	Autoformat,
	Bold,
	BlockQuote,
	Code,
	CodeBlock,
	Essentials,
	FindAndReplace,
	Font,
	FontBackgroundColor,
	FontColor,
	FontFamily,
	FontSize,
	Heading,
	Highlight,
	HorizontalLine,
	HtmlEmbed,
	GeneralHtmlSupport,
	Image,
	ImageCaption,
	ImageInsert,
	ImageStyle,
	ImageToolbar,
	Indent,
	Italic,
	Link,
	List,
	MediaEmbed,
	PageBreak,
	Paragraph,
	PasteFromOffice,
	RemoveFormat,
	SelectAll,
	SourceEditing,
	SpecialCharacters,
	SpecialCharactersEssentials,
	Strikethrough,
	Style,
	Subscript,
	Superscript,
	Table,
	TableToolbar,
	Underline,
	Undo,
]

MailingEditor.defaultConfig = {
	language: "nl",
	toolbar: {
		items: [
			"undo",
			"redo",
			"|",
			"sourceEditing",
			"findAndReplace",
			"selectAll",
			"|",
			"heading",
			"style",
			"fontSize",
			"fontFamily",
			"fontColor",
			"fontBackgroundColor",
			"highlight",
			"|",
			"bold",
			"italic",
			"underline",
			"strikethrough",
			"subscript",
			"superscript",
			"removeFormat",
			"|",
			"alignment",
			"bulletedList",
			"numberedList",
			"outdent",
			"indent",
			"link",
			"blockQuote",
			"insertTable",
			"insertImage",
			"mediaEmbed",
			"code",
			"codeBlock",
			"htmlEmbed",
			"horizontalLine",
			"pageBreak",
			"specialCharacters",
		],
		shouldNotGroupWhenFull: true,
	},
	table: {
		contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"],
	},
	image: {
		toolbar: ["imageTextAlternative", "imageStyle:inline", "imageStyle:block"],
	},
	style: {
		definitions: [
			{ name: "Info box", element: "p", classes: ["info-box"] },
			{ name: "Small text", element: "p", classes: ["small-text"] },
		],
	},
}

export default MailingEditor
