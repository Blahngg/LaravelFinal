<x-app>
    
    <form action="{{ route('rating.store') }}" method="POST" class=" bg-gray-900">
        @csrf
        <div class="mb-5">
            <label for="rating" 
                class="block mb-2 text-sm font-medium text-gray-900">
                    Rating
            </label>
            <select id="rating" name="rating"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
            </select>
        </div>

        <div class="mb-5">
            <label for="review" 
                class="block mb-2 text-sm font-medium text-gray-900">
                    Your review
            </label>
            <textarea id="review" rows="4" name="review"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                placeholder="Leave a review...">
            </textarea>
        </div>
        <button type="submit" 
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Submit
        </button>
    </form>

</x-app>
