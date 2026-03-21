<x-layouts.app title="Correo 1">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="xl">Información de Estudiantes de Programación Web 2026 - versión 1</flux:heading>

        @php
            $estudiantes = [
                ['Nombre' => 'Jeremy Fernández', 'Edad' => 23, 'Carrera' => 'Ing. Civil'],
                ['Nombre' => 'Josue Montero', 'Edad' => 20, 'Carrera' => 'Arquitectura'],
                ['Nombre' => 'Yuliana Gonazalez', 'Edad' => 21, 'Carrera' => 'Marketing'],
            ];
        @endphp

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-700 bg-white border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                <thead class="bg-gray-50 text-gray-600 font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200">Nombre</th>
                        <th class="px-6 py-3 border-b border-gray-200">Edad</th>
                        <th class="px-6 py-3 border-b border-gray-200">Carrera</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($estudiantes as $estudiante)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">{{ $estudiante['Nombre'] }}</td>
                        <td class="px-6 py-4">{{ $estudiante['Edad'] }}</td>
                        <td class="px-6 py-4">{{ $estudiante['Carrera'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>