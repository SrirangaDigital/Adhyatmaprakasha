	<div class="footer">
			<div class="foot_box">
				<div class="fleft">
					&copy;2007-2025 Adhyatmaprakasha Karyalaya, Holenarsipura. All Rights Reserved
				</div>
				<div class="fright">
					<ul>
						<li><a href="http://www.srirangadigital.com/" target="_blank">Designed, Developed and Maintained by <span class="developedby">Sriranga Digital </span> &nbsp;<img class="developedby-logo" src="<?php echo $base_url; ?>php/images/sriranga-logo.png" alt="" /></a></li>
					</ul>
				</div>
			</div>
	</div>
</div> <!-- page div closes here -->

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Select the parent div with the class "header"
    const headerDiv = document.querySelector('.header');
    
    // Select all `a` tags within the header
    const navLinks = headerDiv.querySelectorAll('a');

    // --- Part 1: Restore the active class on page load ---
    const storedActiveLink = localStorage.getItem('active-nav-link');
    if (storedActiveLink) {
        navLinks.forEach(link => {
            if (link.textContent.toLowerCase().trim() === storedActiveLink) {
                link.classList.add('active');
            }
        });
    }

    // --- Part 2: Handle click and save the active class to local storage ---
    if (headerDiv) {
        // Add a click event listener to the parent div using event delegation.
        headerDiv.addEventListener('click', (event) => {
            // Find the closest parent <a> tag to the clicked element
            const clickedLink = event.target.closest('a');

            if (clickedLink) {
                // Get the text of the clicked link
                const clickedText = clickedLink.textContent.toLowerCase().trim();

                // Determine which link should become active based on the clicked link's text
                let targetLinkText = clickedText;
                if (['volumes', 'articles', 'authors'].includes(clickedText)) {
                    // Get the text of the "Magazine" link to store it
                    const magazineLink = document.querySelector("#magazine");
                    if (magazineLink) {
                        targetLinkText = magazineLink.textContent.toLowerCase().trim();
                    }
                } else if (['kannada books', 'sanskrit books', 'english books', 'other books'].includes(clickedText)) {
                    // Get the text of the "Publications" link to store it
                    const publicationsLink = document.querySelector("#publications");
                    if (publicationsLink) {
                        targetLinkText = publicationsLink.textContent.toLowerCase().trim();
                    }
                }
                
                // Store the text of the target link in local storage
                localStorage.setItem('active-nav-link', targetLinkText);
            }
        });
    }
});
</script>

</body>
</html>