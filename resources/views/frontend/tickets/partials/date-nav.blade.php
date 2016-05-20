<ul class="nav nav-tabs nav-justified hidden-xs">
    <li>{{ link_to_route('tickets.search', $title = 'Previous Week', $parameters = array_add($data, 'date_new', '-4')) }}</li>
    <li>{{ link_to_route('tickets.search', $title = $date_list[-3], $parameters = array_add($data, 'date_new', '-3')) }}</li>
    <li>{{ link_to_route('tickets.search', $title = $date_list[-2], $parameters = array_add($data, 'date_new', '-2')) }}</li>
    <li>{{ link_to_route('tickets.search', $title = $date_list[-1], $parameters = array_add($data, 'date_new', '-1')) }}</li>
    <li class="active"><a>{{ $date_list[0] }}</a></li>
    <li>{{ link_to_route('tickets.search', $title = $date_list[1], $parameters = array_add($data, 'date_new', '+1')) }}</li>
    <li>{{ link_to_route('tickets.search', $title = $date_list[2], $parameters = array_add($data, 'date_new', '+2')) }}</li>
    <li>{{ link_to_route('tickets.search', $title = $date_list[3], $parameters = array_add($data, 'date_new', '+3')) }}</li>
    <li>{{ link_to_route('tickets.search', $title = 'Next Week', $parameters = array_add($data, 'date_new', '+4')) }}</li>
</ul>