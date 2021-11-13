<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data){
                return "
                <form action='' class='m-0 p-0 d-inline'><a href='/products/".$data->id."/edit' class='btn btn-warning'>Edit</a></form>
                <form action='/products/".$data->id."' method='post' class='m-0 p-0 d-inline'>
                <input type='hidden' name='_token' value=' ".csrf_token()." '>
                <input type='hidden' name='_method' value='DELETE'>
                <button type='submit' class='btn btn-danger' ".((count($data->sold)>0 || count($data->stocks)>0)?"disabled":"").">DELETE</button></form>
                ";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->with(["getbrand","getcategory"]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    // ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                        
                    )->parameters([
                        'responsive' => true,
                        'autoWidth' => false,
                        
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('price'),
            Column::make('stock'),
            "getbrand"=>  new \Yajra\DataTables\Html\Column(['title' => 'Brand', 'data' => 'getbrand.name', 'name' => 'getbrand.name']),
            "getcategory"=>  new \Yajra\DataTables\Html\Column(['title' => 'Catergory', 'data' => 'getcategory.name', 'name' => 'getcategory.name']),
            
            Column::make("action")->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
