@props(['title'])
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{request()->tab == null || request()->tab == 'group' ? 'active' : ''}}" href="?tab=group">Group</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->tab == 'panelist' ? 'active' : ''}}" href="?tab=panelist">Panelist</a>
    </li>
    @if ($title->group->status == 'Ongoing')
        <li class="nav-item">
            <a class="nav-link {{request()->tab == 'progress' ? 'active' : ''}}" href="?tab=progress">Progress report</a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link {{request()->tab == 'oral' ? 'active' : ''}}" href="?tab=oral">Oral Defense Request</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->tab == 'revision' ? 'active' : ''}}" href="?tab=revision">Revisions</a>
    </li>
</ul>
