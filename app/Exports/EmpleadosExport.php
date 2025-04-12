namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpleadosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Empleado::select('num_empleado', 'nombres', 'apellidos', 'email')->get();
    }

    public function headings(): array
    {
        return ['Número de Empleado', 'Nombres', 'Apellidos', 'Correo Electrónico'];
    }
}
