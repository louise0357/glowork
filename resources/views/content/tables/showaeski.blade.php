@extends('layouts/layoutMaster')

@section('title', 'Accordion - UI elements')
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/toastr/toastr.scss',
  'resources/assets/vendor/libs/animate-css/animate.scss'
])
@endsection
<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/toastr/toastr.js'
    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite([
    'resources/assets/js/tables-datatables-template.js',
    'resources/assets/js/ui-toasts.js'
    ])
@endsection
    
@section('content')
    <h1>{{ $table->name }}</h1>
    <h2>Columns</h2>
    <form action="{{ route('tables.addColumn', $table) }}" method="POST">
        @csrf
        <label for="name">Column Name</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Add Column</button>
    </form>
    <ul>
        @foreach ($columns as $column)
            <li>{{ $column->name }}</li>
        @endforeach
    </ul>

    <h2>Rows</h2>
    <form action="{{ route('tables.addRow', $table) }}" method="POST">
        @csrf
        @foreach ($columns as $column)
            <label for="column_{{ $column->id }}">{{ $column->name }}</label>
            <input type="text" name="column_{{ $column->id }}" id="column_{{ $column->id }}" required>
        @endforeach
        <button type="submit">Add Row</button>
    </form>
    <table>
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ $column->name }}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($row->cellContents as $cell)
                        <td>{{ $cell->content }}</td>
                    @endforeach
                    <td>
                        <form action="{{ route('tables.updateRow', $row) }}" method="POST">
                            @csrf
                            @foreach ($row->cellContents as $cell)
                                <label for="column_{{ $cell->column_id }}">{{ $cell->column->name }}</label>
                                <input type="text" name="column_{{ $cell->column_id }}" id="column_{{ $cell->column_id }}" value="{{ $cell->content }}" required>
                            @endforeach
                            <button type="submit">Update Row</button>
                        </form>
                        <form action="{{ route('tables.addComment', $row) }}" method="POST">
                            @csrf
                            <label for="comment">Comment</label>
                            <input type="text" name="comment" id="comment" required>
                            <button type="submit">Add Comment</button>
                        </form>
                        <ul>
                            @foreach ($row->comments as $comment)
                                <li>{{ $comment->user->name }}: {{ $comment->comment }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
