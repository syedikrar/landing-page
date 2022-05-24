<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="robots" content="" />

    <title>Thank You</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
    {{-- <script defer src="/templates/devbook/fontawesome.js"></script> --}}
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">

    <script src="https://unpkg.com/grapesjs"></script>
</head>
<style>
    body{
        margin: 0;
    }
    /* Let's highlight canvas boundaries */
    #gjs {
        border: 3px solid #444;
    }

    /* Reset some default styling */
    .gjs-cv-canvas {
        top: 0;
        width: 100%;
        height: 100%;
    }

    .gjs-block {
        width: auto;
        height: auto;
        min-height: auto;
    }

    .panel__top {
        padding: 0;
        width: 100%;
        display: flex;
        position: initial;
        justify-content: center;
        justify-content: space-between;
    }

    .panel__basic-actions {
        position: initial;
    }

    .editor-row {
        display: flex;
        justify-content: flex-start;
        align-items: stretch;
        flex-wrap: nowrap;
        height: 300px;
    }

    .editor-canvas {
        flex-grow: 1;
    }

    .panel__right {
        flex-basis: 230px;
        position: relative;
        overflow-y: auto;
    }

    .panel__switcher {
        position: initial;
    }

    .gjs-cv-canvas {
        background-color: rgba(0, 0, 0, .15);
        box-sizing: border-box;
        width: 85%;
        height: calc(100% - 40px);
        bottom: 0;
        overflow: hidden;
        z-index: 1;
        position: absolute;
        left: 0;
        top: 40px;
    }

    .gjs-pn-buttons {
        justify-content: flex-end;
    }

    /* Paste this css to your style sheet file or under head tag */
    /* This only works with JavaScript, 
    if it's not present, don't show loader */
    .no-js #loader {
        display: none;
    }

    .js #loader {
        display: block;
        position: absolute;
        left: 100px;
        top: 0;
    }

    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url("{{ asset('templates/Settings.gif') }}") center no-repeat #fff;
    }

</style>

<body>
    <div class="panel__top">
        <div class="panel__basic-actions"></div>
    </div>
    <div id="gjs">
        @if ($pageData)
            {!! $pageData->html_data !!}
        @else
            <div class="content-wrapper">
                <div class="content">
                    <div class="wrapper-1">
                        <div class="wrapper-2">
                            <h2 class="icon"><i class="fas fa-check"></i></h2>
                            <h1>Thank you !</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                            <a class="go-home" href="/">
                                go back
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {

        var editor = grapesjs.init({

            canvas: {
                styles: [
                    'https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro',
                    '/templates/thankyou/style.css',
                ],
                scripts: [
                    'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js',
                    'https://kit.fontawesome.com/8b6502498a.js'
                ],
            },
            fromElement: true,
            width: 'auto',
            height: '800px',
            fromElement: 1,
            clearOnRender: true,
            container: '#gjs',
            forceClass: false,
            selectorManager: { componentFirst: true },
            storageManager: {
                autosave: false,
                setStepsBeforeSave: 1,
                type: 'remote',
                params: {
                    landing_id: "{{ $landing->id }}"
                },
                urlStore: "{{ route('client.landing.save_thankyou_page_data') }}",
                urlLoad: "",
                contentTypeJson: true,
            },

        });

        //Undo button
        editor.Panels.addButton('options',
            [{
                id: 'undo',
                className: 'fa fa-undo',
                command: 'undo',
                attributes: {
                    title: 'Undo'
                }
            }]
        );
        //Save button
        editor.Panels.addButton('options',
            [{
                id: 'save-db',
                className: 'fa fa-floppy-o',
                command: 'save-db',
                attributes: {
                    title: 'Save DB'
                }
            }]
        );
        //   Exit button
        editor.Panels.addButton('views',
            [{
                id: 'exit',
                className: 'fa fa-window-close',
                command: 'exit-editor',
                attributes: {
                    title: 'Exit Editor'
                }
            }]
        );

        // Add save command
        editor.Commands.add('save-db', {
            run: function(editor, sender) {
                sender && sender.set('active');
                editor.store(swal("Saved!", "Landing page has been updated!", "success"));
            }
        });
        // Add exit command
        editor.Commands.add('exit-editor', {
            run: function(editor, sender) {
                window.location.href = "{{ route('client.landing.index') }}"
                editor.store(swal("Saved!", "Landing page has been updated!", "success"));
            }
        });
        // Add undo command
        editor.Commands.add('undo', {
            run: function(editor, sender) {
                editor.UndoManager.undo();
            }
        });
        // remove the buttons

        //   editor.Panels.removeButton("views", "open-layers");
        editor.Panels.removeButton("views", "open-blocks");
        // editor.Panels.removeButton("views", "open-sm");
        editor.Panels.removeButton("options", "sw-visibility");
        editor.Panels.removeButton("options", "export-template");

        editor.Commands.add('tlb-asset-manager', {
            run: function(editor, sender, opts) {
                editor.AssetManager.open({
                    select(asset, complete) {
                        const selected = editor.getSelected();
                        if (selected && selected.is('image')) {
                            selected.set('src', asset.getSrc());
                            complete && editor.AssetManager.close();
                        }
                    }
                });
            }
        });

        editor.on('component:selected', () => {
            const selectedComponent = editor.getSelected();
            const newToolbar = [{
                    attributes: {
                        class: 'fa fa-arrows'
                    },
                    command: 'tlb-move'
                },
                {
                    attributes: {
                        class: 'fa fa-clone'
                    },
                    command: 'tlb-clone'
                },
                {
                    attributes: {
                        class: 'fa fa-trash'
                    },
                    command: 'tlb-delete'
                }
            ]

            selectedComponent.set({
                toolbar: newToolbar
            });

            if (selectedComponent.is('image')) {
                selectedComponent.set({
                    toolbar: [{
                            attributes: {
                                class: 'fa fa-upload'
                            },
                            command: 'tlb-asset-manager'
                        },
                        ...newToolbar
                    ]
                });
            }
        });

        editor.setStyle(JSON.parse(@json($pageData ? $pageData->styles_data: [])));
    });
</script>
