<form>
<div class="dashboard">
		<p class="announce-para">Announcement <span> PST Deployment</span></p>
		<div class="logos">
			<div class="logo">
				<img src="<?=base_url('assets/img/logo.png')?>" alt="Logo 1" width="50" />
			</div>
			<div class="logo">
				<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50" />
			</div>
		</div>
	</div>
	<div class="divider"></div>
    <div class="space"></div>
    <input type="text" name="id" id="id" value="<?php echo $_SESSION['ID']; ?>" hidden>
    <div id="announcelist">
    
       
    </div>
</form>
<script>
    $(document).ready(function() {
		FetchAllAnnouncement();
    })

    function toggleLike(event) {
        const likeButton = event.target;
        const announcementContainer = likeButton.closest('.likes-container'); 
        const announcementId = announcementContainer.dataset.id; 
        const likeCount = announcementContainer.querySelector('.likeCount');
        const userId = $('#id').val();
        const liked = likeButton.classList.toggle('active');

        $.ajax({
            type: 'POST',
            url: '<?= site_url('StudentController/UpdateLikeStatus') ?>',
            data: {
                id: announcementId,
                userid: userId,
            },
            success: function(response) {
                const data = typeof response === 'string' ? JSON.parse(response) : response;
                likeCount.textContent = data.likes; 
                if (data.likes !== likeCount.textContent && !liked) {
                likeButton.classList.remove('active');
                 }
            },
            error: function(xhr, status, error) {
                console.error('Error updating like status:', xhr.responseText || error);
                likeButton.classList.toggle('active', !liked);
            }
        });
    }

    function toggleHeart(event) {
        const announcement = event.target.closest('.todo-itemprof');
        const heartButton = event.target;
        const heartCount = announcement.querySelector('.heartCount');
        const hearted = heartButton.classList.toggle('active');

        heartCount.textContent = hearted 
            ? parseInt(heartCount.textContent) + 1 
            : parseInt(heartCount.textContent) - 1;
    }

    function FetchAllAnnouncement() {
        const userId = $('#id').val();  
        $.ajax({
            type: 'POST', 
            url: '<?= site_url('StudentController/FetchAnnouncement') ?>',
            data: {
                ID: userId  
            },
            dataType: 'json',
            success: function(response) {    
                $('#announcelist').empty(); 
                if (response && response.length > 0) {
                    response.forEach(function(info) {
                        let appendPost;
                        if (info.Picture === '') {
                            appendPost = $(`
                                <div class="todo-itemprof">
                                    <div class="announce-delete">
                                        <h2>${info.Title}</h2>
                                        <p class="date-pin">${info.Date}</p> 
                                    </div>
                                    <div style="width: 90%; margin-left: 3%;">
                                        <h2 style="font-weight: 500;">${info.Post}</h2>
                                        <br>
                                        <small>- ${info.Author}</small>
                                    </div>
                                    <div class="likes-container" data-id="${info.ID}">
                                        <small>
                                            <span class="fa fa-thumbs-up like-button ${info.liked ? 'active' : ''}" aria-hidden="true" onclick="toggleLike(event)"></span>
                                            <span class="likeCount">${info.Likes}</span>
                                        </small>
                                        <small>
                                            <span class="fa fa-heart heart-button ${info.hearted ? 'active' : ''}" aria-hidden="true" onclick="toggleHeart(event)"></span>
                                            <span class="heartCount">${info.Heart}</span>
                                        </small>
                                    </div>
                                </div>
                            `);
                        } else {
                            const imageUrl = `<?= base_url('assets/uploads/') ?>${info.Picture}`;
                            appendPost = $(`
                                <div class="todo-itemprof">
                                    <div class="announce-delete">
                                        <h2>${info.Title}</h2>
                                        <p class="date-pin">${info.Date}</p> 
                                    </div>
                                    <br>
                                    <div class="empty">
                                        <div class="pic-announce">
                                            <img src="${imageUrl}" alt="Post Image">
                                        </div>
                                        <div class="pic-description">
                                            <div style="width: 90%; margin-left: 3%;">
                                                <h2 style="font-weight: 500;">${info.Post}</h2>
                                            </div>
                                            <br>
                                            <small>- ${info.Author}</small>
                                            <div class="likes-container" data-id="${info.ID}">
                                                <small>
                                                    <span class="fa fa-thumbs-up like-button ${info.liked ? 'active' : ''}" aria-hidden="true" onclick="toggleLike(event)"></span>
                                                    <span class="likeCount">${info.Likes}</span>
                                                </small>
                                                <small>
                                                    <span class="fa fa-heart heart-button ${info.hearted ? 'active' : ''}" aria-hidden="true" onclick="toggleHeart(event)"></span>
                                                    <span class="heartCount">${info.Heart}</span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }
                        $('#announcelist').append(appendPost);
                    });
                } else {
                    var noCurrentPost = $(`
                        <div class="todo-itemprof">
                            <a class="date-pin">N/A</a> <br>
                            <h2>No Current Announcements Posted</h2>
                            <br>
                            <small>- Please regularly check the announcements to stay informed about any updates regarding deployments.</small>
                        </div>
                    `);
                    $('#announcelist').append(noCurrentPost);
                }
            },
            error: function(error) {
                console.error('Error fetching announcements:', error);
            }
        });
    }


</script>