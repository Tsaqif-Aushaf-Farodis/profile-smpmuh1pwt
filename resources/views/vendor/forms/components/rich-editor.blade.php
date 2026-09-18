<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    @unless ($isDisabled())
        <div
            wire:ignore
            x-data="{
                state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
                editor: null,
                loadTinyMce() {
                    if (window.tinymce) {
                        return Promise.resolve()
                    }

                    if (! window.__tinymceLoaderPromise) {
                        window.__tinymceLoaderPromise = new Promise((resolve) => {
                            let script = document.createElement('script')
                            script.src = 'https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js'
                            script.referrerPolicy = 'origin'
                            script.onload = () => resolve()
                            document.head.appendChild(script)
                        })
                    }

                    return window.__tinymceLoaderPromise
                },
                init() {
                    this.loadTinyMce().then(() => {
                        tinymce.init({
                            target: this.$refs.textarea,
                            height: 400,
                            menubar: false,
                            branding: false,
                            toolbar_mode: 'wrap',
                            placeholder: @js($getPlaceholder()),
                            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
                            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image media table | strikethrough hr | code fullscreen preview',
                            setup: (editor) => {
                                this.editor = editor

                                editor.on('init', () => {
                                    editor.setContent(this.state ?? '')
                                })

                                editor.on('change keyup undo redo blur', () => {
                                    this.state = editor.getContent()
                                })
                            },
                        })
                    })
                },
                destroy() {
                    this.editor?.remove()
                },
            }"
            x-init="init()"
            {{ $attributes->merge($getExtraAttributes())->class(['filament-forms-rich-editor-component']) }}
        >
            <textarea x-ref="textarea"></textarea>
        </div>
    @else
        <div
            x-data="{ state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }} }"
            x-html="state"
            @class([
                'prose block w-full max-w-none rounded-lg border border-gray-300 bg-white p-3 opacity-70 shadow-sm',
                'dark:prose-invert dark:border-gray-600 dark:bg-gray-700' => config('forms.dark_mode'),
            ])
        ></div>
    @endunless
</x-dynamic-component>
