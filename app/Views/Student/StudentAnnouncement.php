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
    <div id="announcelist">
    
       
    </div>
</form>
<script>
    $(document).ready(function() {
		FetchAllAnnouncement();
    })

    function FetchAllAnnouncement() {
        $.ajax({
            type: 'POST', 
            url: '<?= site_url('StudentController/FetchAnnouncement') ?>',
            success: function(response) {    
                if (response && response.length > 0) {
                            response.forEach(function(info) {
                                if (info.Picture === '') {
                                    var appendPost = $(`
                                    <div class="todo-itemprof">
                                    <div class="announce-delete">
                                        <h2>${info.Title} </h2>
                                        <p class="date-pin" >${info.Date}</p> 
                                        </div>
                                        <div style="width: 90%; margin-left: 3%;">
                                        <h2 style="font-weight: 500;">${info.Post}</h2>
                                        <br>
                                        <small>- ${info.Author}</small>
                                        </div>
                                                <div class="likes-container">
                                                    <small>
                                                        <span class="fa fa-thumbs-up" aria-hidden="true"></span> ${info.Likes}
                                                    </small>
                                                    <small>
                                                        <span class="fa fa-heart" aria-hidden="true"></span> ${info.Heart}
                                                    </small>
                                                </div>
                                             </div>            
                                    `);
                                 } else {
                                    var imageUrl = `<?= base_url('assets/uploads/') ?>${info.Picture}`;
                                    var appendPost = $(`
                                    <div class="todo-itemprof">
                                        <div class="announce-delete">
                                        <h2>${info.Title} </h2>
                                        <p class="date-pin" >${info.Date}</p> 
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
                                                <div class="likes-container">
                                                    <small>
                                                        <span class="fa fa-thumbs-up" aria-hidden="true"></span> ${info.Likes}
                                                    </small>
                                                    <small>
                                                        <span class="fa fa-heart" aria-hidden="true"></span> ${info.Heart}
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
			
            }
            });
    }

</script>