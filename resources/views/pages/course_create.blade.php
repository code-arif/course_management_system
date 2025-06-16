@extends('layout.app')
@section('content')
    <div class="form-container">
        <header>
            <h1>Create New Course</h1>
            <button class="add-course" onclick="window.location.href='{{ route('all.courses') }}'"> All
                Courses</button>
        </header>

        <form id="courseForm" onsubmit="createCourse(event)">
            {{-- title --}}
            <div class="form-group">
                <label for="title">Course Title <span style="color: red">*</span></label>
                <input type="text" id="title" name="title" maxlength="255" />
                <p class="error-message" id="title-error"></p>
            </div>

            {{-- description --}}
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" maxlength="2000"></textarea>
                <p class="error-message" id="description-error"></p>
            </div>


            <div class="form-group">
                <div class="flex-row">
                    {{-- category --}}
                    <div>
                        <label for="category">Category <span style="color: red">*</span></label>
                        <input type="text" id="category" name="category" maxlength="100" />
                        <p class="error-message" id="category-error"></p>
                    </div>

                    {{-- course price --}}
                    <div>
                        <label for="price">Price (BDT)</label>
                        <input type="number" id="price" name="price" min="0" max="999999.99" step="0.01" />
                        <p class="error-message" id="price-error"></p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="flex-row">
                    {{-- course duration --}}
                    <div>
                        <label for="duration">Duration</label>
                        <input type="text" id="duration" name="duration" maxlength="100" />
                        <p class="error-message" id="duration-error"></p>
                    </div>

                    {{-- thumbnail url --}}
                    <div>
                        <label for="thumbnail">Thumbnail URL</label>
                        <input type="url" id="thumbnail" name="thumbnail" maxlength="255" />
                        <p class="error-message" id="thumbnail-error"></p>
                    </div>
                </div>
            </div>

            {{-- course status --}}
            <div class="form-group">
                <div class="flex-row">
                    <div>
                        <label for="status">Status <span style="color: red">*</span></label>
                        <select id="status" name="status">
                            <option value="">--Select Status--</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                        <p class="error-message" id="status-error"></p>
                    </div>

                    {{-- instructor name --}}
                    <div>
                        <label for="instructor_name">Instructor Name</label>
                        <input type="text" id="instructor_name" name="instructor_name" maxlength="100" />
                        <p class="error-message" id="instructor_name-error"></p>
                    </div>
                </div>
            </div>

            {{-- publishing date --}}
            <div class="form-group">
                <label for="published_at">Published Date</label>
                <input type="date" id="published_at" name="published_at" />
                <p class="error-message" id="published_at-error"></p>
            </div>

            {{--  course modules section --}}
            <div class="modules">
                <h2>Modules</h2>
                <div id="modulesContainer"></div>
                <button type="button" id="addModuleBtn" class="add-btn">+ Add Module</button>
            </div>

            {{-- course creat ebutton --}}
            <div class="form-footer">
                <button type="submit">Create Course</button>
            </div>
        </form>

        {{-- loading animation --}}
        <div id="loadingOverlay" class="loading-overlay" style="display: none;">
            <div class="spinner"></div>
            <p>Creating course, please wait...</p>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let moduleCount = 0;

            // function to add a new module block
            function addModule() {
                moduleCount++;
                const moduleHTML = `
                    <div class="module" data-module-index="${moduleCount}">
                        <div class="module-header">
                            {{-- module title --}}
                            <div class="form-group">
                                <label>Module Title <span style="color: red">*</span></label>
                                <input type="text" name="modules[${moduleCount}][title]" maxlength="255" />
                            </div>

                            {{-- module summary --}}
                            <div class="form-group">
                                <label>Summary</label>
                                <textarea name="modules[${moduleCount}][summary]" rows="2" placeholder="Module summary..."></textarea>
                            </div>

                            {{-- module duration --}}
                            <div class="form-group">
                                <div class="flex-row"> 
                                    <div>
                                        <label>Duration</label>
                                        <input type="text" name="modules[${moduleCount}][duration]" placeholder="e.g. 1h 30m" />
                                    </div>

                                    <div>
                                        <label>Status</label>
                                        <select name="modules[${moduleCount}][status]">
                                            <option value="draft">Draft</option>
                                            <option value="published">Published</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="remove-btn remove-module-btn">Remove Module</button>
                        </div>

                        <div class="contents">
                            <h4>Contents</h4>
                            <div class="contents-container"></div>
                            <button type="button" class="add-btn add-content-btn">+ Add Content</button>
                        </div>
                    </div>
                `;
                $('#modulesContainer').append(moduleHTML);
            }

            // function to add content inside a module
            function addContent(moduleIndex, contentIndex) {
                const contentHTML = `
                    <div class="content" data-content-index="${contentIndex}">
                        <div class="flex-row">
                            <div class="form-group">
                                <label>Content Title <span style="color: red">*</span></label>
                                <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][title]" />
                            </div>

                            <div class="form-gorup">
                                <label>Type <span style="color: red">*</span></label>
                                <select name="modules[${moduleIndex}][contents][${contentIndex}][type]">
                                    <option value="">--Select--</option>
                                    <option value="text">Text</option>
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                    <option value="link">Link</option>
                                    <option value="pdf">PDF</option>
                                    <option value="quiz">Quiz</option>
                                </select>
                            </div>

                            <div class="form-gorup">
                                <label>Value <span style="color: red">*</span></label>
                                <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][data]" />
                            </div>

                            <div class="form-group">
                                <label>Duration</label>
                                <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][duration]" />
                            </div>

                            <div>
                                <button type="button" class="remove-btn remove-content-btn">Remove</button>
                            </div>
                        </div>
                    </div>
                `;
                $(`.module[data-module-index="${moduleIndex}"] .contents-container`).append(contentHTML);
            }

            // add first module on load
            addModule();

            // handle add module button click
            $('#addModuleBtn').on('click', function() {
                addModule();
            });

            // handle remove module
            $('#modulesContainer').on('click', '.remove-module-btn', function() {
                $(this).closest('.module').remove();
            });

            // handle add content button inside module
            $('#modulesContainer').on('click', '.add-content-btn', function() {
                const moduleDiv = $(this).closest('.module');
                const moduleIndex = moduleDiv.data('module-index');
                const contentCount = moduleDiv.find('.content').length + 1;
                addContent(moduleIndex, contentCount);
            });

            // handle remove content
            $('#modulesContainer').on('click', '.remove-content-btn', function() {
                $(this).closest('.content').remove();
            });
        });


        // handle form submission
        async function createCourse(event) {
            event.preventDefault();

            const form = document.getElementById('courseForm');
            const formData = new FormData(form);

            // show spinner
            $('#loadingOverlay').fadeIn();

            try {
                const response = await axios.post("{{ route('courses.store') }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                    }
                });

                if (response.status === 201 && response.data.status === true) {
                    successToast(response.data.message);
                    setTimeout(() => {
                        window.location.href = "{{ route('all.courses') }}";
                    }, 1100);
                } else {
                    errorToast('Course creation failed');
                }

            } catch (error) {
                if (error.response?.data?.errors) {
                    const errors = error.response.data.errors;

                    // loop through all errors
                    Object.keys(errors).forEach(key => {
                        $(`#${key}-error`).text(errors[key][0]);
                    });

                    errorToast('Check input fields! Please fix the errors');
                } else {
                    errorToast('Something went wrong!');
                }
            } finally {
                $('#loadingOverlay').fadeOut();
            }
        };
    </script>
@endsection
