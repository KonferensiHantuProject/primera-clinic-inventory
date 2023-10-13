@extends('template')
@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="package"></i></div>
                        Items List
                    </h1>
                </div>
                <div class="col-auto mt-4">
                    <a href="/item/create" class="btn btn-sm btn-info"><i data-feather="plus"></i> Add</a>
                    <a href="#" class="btn btn-sm btn-success"><i data-feather="log-out"></i> Export</a>
                    <a href="#" class="btn btn-sm btn-warning"><i data-feather="log-in"></i> Import</a>
                </div>
            </div>
            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Items</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-fluid px-4 mt-n10">
    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-striped" id="item-table">
                <thead>
                    <tr>
                        <th>Kode Item</th>
                        <th>Item</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Item</th>
                        <th>Item</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->kode_item }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->unit->name }}</td>
                            <td>{{ $item->stock_sum_quantity }}</td>
                            <td>
                                <a class="btn btn-sm btn-info me-2" href="/item/{{ $item->id }}"><i data-feather="info"></i></a>
                                <a class="btn btn-sm btn-success me-2" href="/item/{{ $item->id }}/edit"><i data-feather="edit"></i></a>
                                <a class="btn btn-sm btn-danger btn-delete" data-id="{{ $item->id }}" href="#"><i data-feather="trash-2"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    let itemTable = document.getElementById('item-table');

    // itemTable.addEventListener('click', function(e){
    //     console.log(e.target.parentElement);
    //     if(e.target.parentElement){}
    // })

    let btnDelete = document.querySelectorAll('.btn-delete');

    btnDelete.forEach(el => {
        el.addEventListener('click', function(e){
            el.getAttribute('data-id');
            Helper.confirmAlert('Hapus Data', 'warning', 'Ya').then(result => {
                if(result.isConfirmed){
                    Helper.fetchDelete(`/item/${el.getAttribute('data-id')}`)
                        .then(response => response.json())
                        .then(response => {
                            Helper.simpleNotification(response.message, '', response.status).then(res => response.error === 0 ? Helper.refresh() : '');
                        })
                }
            });
        })
    })
</script>
@endsection
