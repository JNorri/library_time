document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('editModal');
    const modalClose = modal.querySelector('.modal-close');
    const editButtons = document.querySelectorAll('.edit-btn');
    const editForm = document.getElementById('editForm');
    const recordIdInput = document.getElementById('recordId');
    const nameInput = document.getElementById('name');
    let isFormDirty = false;

    // Открытие модального окна
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const recordId = this.getAttribute('data-id');
            recordIdInput.value = recordId;
            fetch(`/api/department/${recordId}`)
                .then(response => response.json())
                .then(data => {
                    nameInput.value = data.department_name;
                    modal.classList.remove('hidden');
                });
        });
    });

    // Закрытие модального окна
    modalClose.addEventListener('click', function () {
        if (isFormDirty) {
            if (confirm('У вас есть несохраненные изменения. Вы уверены, что хотите закрыть?')) {
                modal.classList.add('hidden');
                isFormDirty = false;
            }
        } else {
            modal.classList.add('hidden');
        }
    });

    // Закрытие модального окна по клику вне его
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            if (isFormDirty) {
                if (confirm('У вас есть несохраненные изменения. Вы уверены, что хотите закрыть?')) {
                    modal.classList.add('hidden');
                    isFormDirty = false;
                }
            } else {
                modal.classList.add('hidden');
            }
        }
    });

    // Отслеживание изменений в форме
    editForm.addEventListener('input', function () {
        isFormDirty = true;
    });

    // Отправка формы
    editForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(editForm);
        fetch(`/api/department/update/${recordIdInput.value}`, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Запись успешно обновлена');
                    modal.classList.add('hidden');
                    isFormDirty = false;
                } else {
                    alert('Не удалось обновить запись');
                }
            });
    });
});