<?php

namespace App\DataTables;

use App\Models\Emi;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmisDataTable extends DataTable
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
                <form action='' class='m-0 p-0 d-inline'><a href='/emi/".$data->id."' class='btn btn-primary'>View</a></form>
                <form action='' class='m-0 p-0 d-inline'><a href='/emi/".$data->id."/edit' class='btn btn-warning'>Edit</a></form>
                <form action='' class='m-0 p-0 d-inline'><button type='submit' class='btn btn-danger' disabled>DELETE</button></form>
                ";
            })->addColumn('status', function ($data){
                $paid = count($data->emi_entries()->where("paid_date","<>",null)->get());
                $total = count($data->emi_entries);
                return $total == $paid?"Closed":"Pending";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Emi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Emi $model)
    {
        return $model->newQuery()->with(["customer"]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('emis-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::make('id')->hidden(),
            "customer"=>  new \Yajra\DataTables\Html\Column(['title' => 'Customer', 'data' => 'customer.name', 'name' => 'customer.name']),
            Column::make('amount'),
            Column::make('interval'),
            Column::make('period'),
            Column::make('interest_rate'),
            Column::make('start_date'),
            Column::make("status")->sort()->printable(false),
            // "getcategory"=>  new \Yajra\DataTables\Html\Column(['title' => 'Catergory', 'data' => 'getcategory.name', 'name' => 'getcategory.name']),
            
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
        return 'Emis_' . date('YmdHis');
    }
}
