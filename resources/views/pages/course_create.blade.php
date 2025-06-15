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
            <label for="title">Course Title *</label>
            <input type="text" id="title" name="title" required maxlength="255" />

            {{-- description --}}
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" maxlength="2000"></textarea>


            <div class="flex-row">
                {{-- category --}}
                <div>
                    <label for="category">Category *</label>
                    <input type="text" id="category" name="category" required maxlength="100" />
                </div>

                {{-- course price --}}
                <div>
                    <label for="price">Price (BDT)</label>
                    <input type="number" id="price" name="price" min="0" max="999999.99" step="0.01" />
                </div>
            </div>

            <div class="flex-row">
                {{-- course duration --}}
                <div>
                    <label for="duration">Duration</label>
                    <input type="text" id="duration" name="duration" maxlength="100" />
                </div>

                {{-- thumbnail url --}}
                <div>
                    <label for="thumbnail">Thumbnail URL</label>
                    <input type="url" id="thumbnail" name="thumbnail" maxlength="255" />
                </div>
            </div>

            {{-- course status --}}
            <div class="flex-row">
                <div>
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="">--Select Status--</option>
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>

                {{-- instructor name --}}
                <div>
                    <label for="instructor_name">Instructor Name</label>
                    <input type="text" id="instructor_name" name="instructor_name" maxlength="100" />
                </div>
            </div>

            {{-- publishing date --}}
            <label for="published_at">Published Date</label>
            <input type="date" id="published_at" name="published_at" />

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
                            <label>Module Title *</label>
                            <input type="text" name="modules[${moduleCount}][title]" required maxlength="255" />

                            <label>Summary</label>
                            <textarea name="modules[${moduleCount}][summary]" rows="2" placeholder="Module summary..."></textarea>

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
                            <div>
                                <label>Content Title *</label>
                                <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][title]" required />
                            </div>

                            <div>
                                <label>Type *</label>
                                <select name="modules[${moduleIndex}][contents][${contentIndex}][type]" required>
                                    <option value="">--Select--</option>
                                    <option value="text">Text</option>
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                    <option value="link">Link</option>
                                    <option value="pdf">PDF</option>
                                    <option value="quiz">Quiz</option>
                                </select>
                            </div>

                            <div>
                                <label>Value *</label>
                                <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][data]" required />
                            </div>

                            <div>
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
                    errorToast('Please check your inputs.');
                } else {
                    errorToast('Something went wrong!');
                }
            } finally {
                $('#loadingOverlay').fadeOut();
            }
        };
    </script>
@endsection
