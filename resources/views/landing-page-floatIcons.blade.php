<a href="{{ $landingMaps->whatsapp }}" target="_blank">
    <div class="fixed-icons"> </div>
</a>

<style>
    .fixed-icons {
        position: fixed;
        background-image: url("images/icons/whatsapp_logo.png");
        background-size: cover;
        width: 100px;
        height: 100px;
        z-index: 9999;
        bottom: 15px;
        right: 19px;
    }

    @media only screen and (max-width: 991px) {
        .fixed-icons {
            width: 70px;
            height: 66px;
        }
    }
</style>
