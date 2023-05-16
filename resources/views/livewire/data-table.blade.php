<div>
    <table class="table table-striped">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ __($column) }}</th>
                @endforeach
                <th class="actions text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    @foreach ($columns as $column)
                        <td>{{ $item->$column }}</td>
                    @endforeach
                    <td>
                        <a class="btn btn-sm btn-info d-inline mx-1" href="{{ route( $route . '.show', $item->id ) }}">
                            Ver
                        </a>
                        <a class="btn btn-sm btn-primary d-inline mx-1" href="{{ route( $route . '.edit', $item->id ) }}">
                            Editar
                        </a>
                        <form action="{{ route( $route . '.destroy', $item->id) }}" method="POST" class="d-inline mx-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger d-inline" onclick="return confirm('¿Está seguro de eliminar éste registro?');">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="{{ count($columns) + 1 }}">
                        No hay registros para mostrar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $data->appends(request()->input())->links() }}
    </div>

</div>

@push('styles')
<style>
.actions {
    width: 200px;
}
</style>
@endpush
