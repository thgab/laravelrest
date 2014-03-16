@extends('layout')

@section('content')
<div class="container" >
	<div id="robotList"></div>
</div>
	<script type="text/template" id="details">
	<table class="table">
        <thead>
            <tr>
				<th>Id</th>
                <th>Name</th>
                <th>Type</th>
                <th>Year</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
			<% _.each(robots, function(robot)  { %>
				<tr>
					<td><%= robot.id %></td>
					<td><%= robot.name %></td>
					<td><%= robot.type %></td>
					<td><%= robot.year %></td>
					<td><%= robot.created_at %></td>
				</tr>
			<% }); %>
       </tbody>
    </table>
	</script>
@stop