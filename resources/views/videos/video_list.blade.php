<table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th scope="col">Number</th>
        <th scope="col">Name</th>
        <th scope="col">URL</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <input type="number" step="1" class="form-control" id="number" placeholder="Number" autocomplete="off">
            </td>
            <td>
                <input type="text" class="form-control" id="vname" placeholder="Name" autocomplete="off">
            </td>
            <td>
                <input type="text" class="form-control" id="url" placeholder="URL" autocomplete="off">
            </td>
            <td>
                <button type="button" onclick="save()" class="btn btn-primary">Save</button>
            </td>
        </tr>
        @foreach ($videos as $item)
            <tr>
                <td>{{$item->number}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->url}}</td>
                <td><button class="btn btn-danger" onclick="vDelete({{$item->id}})">Delete</button></td>
            </tr>
        @endforeach
    </tbody>
</table>