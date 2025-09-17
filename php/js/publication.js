var id;
var flag=0;

//~ $(document).ready(function(){
	//~ $("li.top").click(function(){
		//~ 
		//~ id = $(this).attr("id");
		//~ 
		//~ var str= "#" + id + " .rest";
	//~ $(str).slideToggle(750);
	//~ });
//~ });

$(document).ready(function(){
	$("span.top").click(function(){
		var pele = this.parentNode;
		id = $(pele).attr("id");
		var str= "#" + id + " .rest";
		$(str).slideToggle(750);
	});
});

        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search-input');
            const languageInput = document.getElementById('language');
            const resultsContainer = document.getElementById('search-results-holder');

            searchInput.addEventListener('keydown', async (event) => {
                // Check if the user pressed the Enter key

                if (event.key === 'Enter') {
                    // Prevent the default form submission behavior (if any)
                    event.preventDefault();

                    const languageInputValue = languageInput.value.trim();
                    const query = searchInput.value.trim();
                    if (query === '') {
                        return;
                    }

                    // Clear previous results and show a loading message
                    resultsContainer.innerHTML = '<p class="text-gray-500 text-center">Searching...</p>';

                    try {
                        // Create a FormData object to send the data
                        const formData = new FormData();
                        formData.append('query', query);
                        formData.append('language', languageInputValue);

                        scriptUrl = base_url + 'php/search-title.php';

                        // Use the Fetch API to send a POST request to the PHP script
                        const response = await fetch(scriptUrl, {
                            method: 'POST',
                            body: formData
                        });

                        // Check if the request was successful
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        // Parse the JSON response
                        const results = await response.json();
                        displayResults(results);

                    } catch (error) {
                        // Handle any errors that occurred during the fetch
                        // console.error('Error fetching search results:', error);
                        resultsContainer.innerHTML = '<p class="search-title-errors">An error occurred. Please try again.</p>';
                    }
                }
            });


			function displayResults(results) {

                resultsContainer.innerHTML = '';

                if ( !results.hasOwnProperty('error') && (results.length > 0)) {
                    const pelement = document.createElement('p');
                    pelement.className = "search-results-heading";
                    pelement.textContent = `Search Results for ${searchInput.value}`;
                    resultsContainer.appendChild(pelement);

                    const pelementatend = document.createElement('p');
                    pelementatend.className = "search-results-endhere";

                    const ul = document.createElement('ul');
                    ul.className = 'space-y-3'; // Tailwind class for spacing

                    results.forEach(book => {
                        const li = document.createElement('li');
                        
                        // Create the title span and link
                        const titleSpan = document.createElement('span');
                        titleSpan.className = 'titlespan';
                        const titleLink = document.createElement('a');
                        titleLink.href = `${languageInput.value}_books_toc.php?book_id=${book.book_id}&type=${book.type}&book_title=${encodeURIComponent(book.book_title)}`;
                        titleLink.textContent = book.book_title;
                        titleSpan.appendChild(titleLink);
                        
                        // Create the author spans and link
                        const br = document.createElement('br');
                        const authorSpan1 = document.createElement('span');
                        authorSpan1.className = 'authorspanspace';
                        authorSpan1.textContent = ' — ';
                        
                        const authorSpan2 = document.createElement('span');
                        authorSpan2.className = 'authorspan';
                        const authorLink = document.createElement('a');
                        authorLink.href = `auth.php?authid=${book.authid}&author=${encodeURIComponent(book.authorname)}&type=${book.type}`;
                        authorLink.textContent = book.authorname;
                        authorSpan2.appendChild(authorLink);

                        // Append all elements to the list item
                        li.appendChild(titleSpan);
                        li.appendChild(br);
                        li.appendChild(authorSpan1);
                        li.appendChild(authorSpan2);

                        ul.appendChild(li);
                    });
                    
                    resultsContainer.appendChild(ul);
					resultsContainer.appendChild(pelementatend);
                } else {
                    resultsContainer.innerHTML = `<p class="search-title-errors">${results.error}</p>`;
                }
            }
        });