<form action="{{ route('courses.destroy', ['slug' => $course->slug]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-primary btnDeleteCoursee text-white">
        <i class="far fa-trash-alt"></i>&nbsp; {{ ("DELETE") }}
    </button>
</form>
