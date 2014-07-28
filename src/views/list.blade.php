<div>
  <ul class="list-unstyled">
    @foreach ($dependencies as $dependency)
      <li>
        <div>
          <h3 class="page-header">
            {{ $dependency->name }}
            <small><strong>({{ $dependency->license }})</strong></small>
          </h3>
          <p>
            {{ $dependency->description }}
          </p>
        </div>
      </li>
    @endforeach
  </ul>
</div>
