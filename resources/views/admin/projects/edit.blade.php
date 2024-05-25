@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-dark text-light">
        <div class="container ">
            <h1>Editing project: {{ $project->project_name }}</h1>
        </div>
    </header>

    <div class="container py-5">

        @include('partials.validation-message')

        <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="project_name" class="form-label">project_name</label>
                <input type="text" class="form-control @error('project_name') is-invalid @enderror" name="project_name" id="project_name"
                    aria-describedby="project_nameHelper" placeholder=".." value="{{ old('project_name', $project->project_name) }}" />
                <small id="project_nameHelper" class="form-text text-muted">type a project_name for this project</small>
                @error('project_name')
                    <div class="text-danger py-2"> {{ $message }}</div>
                @enderror
            </div>



            <div class="d-flex gap-2 mb-3">

                @if (Str::startsWith($project->preview_image, 'https://'))
                    <img width="300px" src=" {{ $project->preview_image }}" alt="{{ $project->project_name }}">
                @else
                    <img width="300px" src="{{ asset('storage/' . $project->preview_image) }}" alt="{{ $project->project_name }}">
                @endif


                <div>
                    <label for="preview_image" class="form-label">preview_image</label>
                    <input type="file" class="form-control  @error('preview_image') is-invalid @enderror"
                        name="preview_image" id="preview_image" aria-describedby="preview_imageHelper" placeholder=".."
                        value="{{ old('preview_image', $project->preview_image) }}" />
                    <small id="preview_imageHelper" class="form-text text-muted">type name of preview_image for this
                        project</small>
                    @error('preview_image')
                        <div class="text-danger py-2"> {{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <textarea name="description" id="description"rows="5" class="form-control  @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="text-danger py-2"> {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </form>
    </div>
@endsection
