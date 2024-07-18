
<section class="anime1">

<?php foreach ($anime_data as $anime): ?>
    
    <a href="video.php?id=<?php echo $anime['vid_id'] ?>">
        <div class="anime_card1"> 
            <div class="card_img">
                <img src="./uploads/images/<?php echo $anime['banner_loc']; ?>">
            </div>
            <div>
                <h1><?php echo $anime['title']; ?></h1>
            </div>
        </div>
    </a>
<?php endforeach; ?>

</section>
