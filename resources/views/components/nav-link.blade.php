@props(['link'=> '#', ])
<a href="{{$link}}" class="nav-item nav-link {{url()->current() == $link ? 'active': ''}}">{{$slot}}</a>
