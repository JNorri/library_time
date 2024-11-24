<div id="editModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Редактировать запись</p>
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M18 1.5L16.5 0 9 7.5 1.5 0 0 1.5 7.5 9 0 16.5 1.5 18 9 10.5 16.5 18 18 16.5 10.5 9z" />
                    </svg>
                </div>
            </div>
            <form id="editForm">
                <!-- Форма для редактирования данных -->
                <input type="hidden" id="recordId" name="recordId">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Название</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <!-- Добавьте другие поля формы здесь -->
                <div class="flex justify-end pt-2">
                    <button type="button" class="modal-close px-4 bg-gray-500 p-3 rounded-lg text-white hover:bg-gray-400">Закрыть</button>
                    <button type="submit" class="px-4 bg-blue-500 p-3 rounded-lg text-white hover:bg-blue-400">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>