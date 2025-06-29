@extends('layouts.app')
@section('styles')
    @vite(['resources/css/vacancies.css'])
@endsection
@section('title')Редактировать данные вакансии @endsection
@section('content')

<div class="container container__create-form">
    <div class="row text-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование вакансии</h2>
            </div>
        </div>
    </div>

    <form id="editVacancyForm">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Название:</strong>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Название" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Описание:</strong>
                    <textarea name="description" id="description" class="form-control" placeholder="Описание" required></textarea>
                </div>
            </div>

            <!-- Select для отдела -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Отдел:</strong>
                    <select name="department_id" id="departmentSelect" class="form-control" required>
                        <option value="">Загрузка отделов...</option>
                    </select>
                </div>
            </div>

            <!-- Select для местоположения -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Местоположение:</strong>
                    <select name="location_id" id="locationSelect" class="form-control" required>
                        <option value="">Загрузка местоположений...</option>
                    </select>
                </div>
            </div>

            <!-- Select для графика работы -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>График работы:</strong>
                    <select name="working_hours_id" id="workingHoursSelect" class="form-control" required>
                        <option value="">Загрузка графиков...</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Зарплата:</strong>
                    <input type="number" name="salary" id="salary" class="form-control" placeholder="Зарплата" step="0.01">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Контактное лицо:</strong>
                    <select name="worker_id" id="workerSelect" class="form-control" required>
                        <option value="">Загрузка контактных лиц...</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                <a class="btn btn-primary" href="/admin/vacancies">Назад</a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const vacancyId = window.location.pathname.split('/').pop();

    Promise.all([
        fetch(`/api/vacancies/${vacancyId}`).then(res => res.json()),
        fetch('/api/departments').then(res => res.json()),
        fetch('/api/locations').then(res => res.json()),
        fetch('/api/working-hours').then(res => res.json()),
        fetch('/api/workers').then(res => res.json())
    ])
    .then(([vacancyData, departments, locations, workingHours, workers]) => {
        const vacancy = vacancyData.vacancy;

        document.getElementById('title').value = vacancy.title;
        document.getElementById('description').value = vacancy.description;
        document.getElementById('salary').value = vacancy.salary;

        const departmentSelect = document.getElementById('departmentSelect');
        departmentSelect.innerHTML = '';
        departments.forEach(dept => {
            const option = new Option(dept.department, dept.department_id);
            departmentSelect.add(option);
        });
        if (vacancy.department_id) {
            departmentSelect.value = vacancy.department_id;
        }

        const locationSelect = document.getElementById('locationSelect');
        locationSelect.innerHTML = '';
        locations.forEach(loc => {
            const option = new Option(loc.location, loc.location_id);
            locationSelect.add(option);
        });
        if (vacancy.location_id) {
            locationSelect.value = vacancy.location_id;
        }

        const workingHoursSelect = document.getElementById('workingHoursSelect');
        workingHoursSelect.innerHTML = '';
        workingHours.forEach(wh => {
            const option = new Option(wh.working_hours, wh.working_hours_id);
            workingHoursSelect.add(option);
        });
        if (vacancy.working_hours_id) {
            workingHoursSelect.value = vacancy.working_hours_id;
        }

        const workerSelect = document.getElementById('workerSelect');
        workerSelect.innerHTML = '';
        workers.workers.data.forEach(worker => {
            const option = new Option(worker.surname + ' ' + worker.name + ' ' + worker.patronymic + ' (' + worker.position + ')', worker.worker_id);
            workerSelect.add(option);
        });
        if (workers.worker_id) {
            workerSelect.worker = worker.worker_id;
        }
    })
    .catch(error => {
        console.error('Ошибка загрузки данных:', error);
    });

    document.getElementById('editVacancyForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = {
            title: document.getElementById('title').value,
            description: document.getElementById('description').value,
            department_id: document.getElementById('departmentSelect').value,
            location_id: document.getElementById('locationSelect').value,
            working_hours_id: document.getElementById('workingHoursSelect').value,
            salary: document.getElementById('salary').value,
            worker_id: document.getElementById('workerSelect').value,
            _method: 'PUT'
        };

        try {
            const response = await fetch(`/api/vacancies/${vacancyId}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });

            if(!response.ok) {
                const errorData = await response.json();
                throw errorData;
            }

            window.location.href = '/admin/vacancies';
        } catch (error) {
            console.error('Ошибка при обновлении:', error);
        }
    });
});
</script>

@endsection
