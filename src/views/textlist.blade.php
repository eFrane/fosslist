@foreach ($dependencies as $dependency)
- {{ $dependency->name }} ({{ $dependency->license }}): {{ $dependency->description or 'No description available.' }}
@endforeach
