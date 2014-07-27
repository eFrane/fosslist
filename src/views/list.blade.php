<div>
  <ul>
    @foreach ($dependencies as $dependency)
      <li>
        <span>{{ $dependency['name'] }}</span>
        <strong>({{ $dependency['license'] }})</strong>
      </li>
    @endforeach
  </ul>
</div>
