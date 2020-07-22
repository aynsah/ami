<div class="table-responsive-sm">
    <table class="table table-striped" id="campaignCategories-table">
        <thead>
            <tr>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($campaignCategories as $campaignCategory)
            <tr>
                <td>{{ $campaignCategory->name }}</td>
                <td>
                    {!! Form::open(['route' => ['campaignCategories.destroy', $campaignCategory->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('campaignCategories.show', [$campaignCategory->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('campaignCategories.edit', [$campaignCategory->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>