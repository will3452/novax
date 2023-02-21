<x-layouts.main>

    <h1 class="page-header">
       REPORTS
    </h1>


    <div>
        <div class="ct-chart"></div>
    </div>

    <form action="/reports">
        <label for="">
            FROM <input name="from" class="form-control" type="date">
        </label>
        <label for="">
            TO <input name="to" class="form-control" type="date">
        </label>
        <button class="btn btn-primary">GENERATE</button>
    </form>
    <div>
        @if (request()->from && request()->to)
        <div class="panel panel-default">
            <div class="panel-heading">
                Result from {{request()->from}} to {{request()->to}}
            </div>
            <div class="panel-body">
                <table class="table table-sm table-bordered">
                    <tr>
                        <th>
                            No. of Patients
                        </th>
                        <td>
                            {{count($patients)}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            No. of Pregnant
                        </th>
                        <td>
                            {{count($pregnants)}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            No. of Children
                        </th>
                        <td>
                            {{count($children)}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            No. of Household
                        </th>
                        <td>
                            {{count($household)}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @endif
    </div>

    <script>
        new Chartist.Line('.ct-chart', {
            labels: [],
            series: [
                [12, 9, 7, 8, 5, 2],
            ]
            }, {
            fullWidth: true,
            chartPadding: {
                right: 40
            }
            });
    </script>
</x-layouts.main>
