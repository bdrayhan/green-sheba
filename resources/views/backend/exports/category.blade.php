<table>
    <thead>
    <tr>
        <th>id</th>
        <th>pc_name</th>
        <th>pc_url</th>
        <th>pc_feature</th>
        <th>pc_orderby</th>
        <th>pc_active</th>
        <th>pc_status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->pc_name }}</td>
            <td>{{ $category->pc_url }}</td>
            <td>{{ $category->pc_feature }}</td>
            <td>{{ $category->pc_orderby }}</td>
            <td>{{ $category->pc_active }}</td>
            <td>{{ $category->pc_status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
