<?php
get_header();
?>
<main class="main contactPage">
    <div class="contactPage__content">
        <div class="contactPage__inner">

            <?php breadcrumbs(); ?>

            <h1 class="page__title"><?php echo get_the_title(); ?></h1>

            <div class="contactPage__text">
                <?php the_content(); ?>
                <div class="soc">
                    <?php
                    wp_nav_menu(
                        array(
                            'menu' => 'socials-menu',
                            'container'       => '',
                            'menu_class'      => 'menu menu_soc',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        )
                    );
                    ?>
                </div>
            </div>
            <div class="contactPage__form">
                <?php echo do_shortcode( '[contact-form-7 id="140" title="Get In Touch"]' ); ?>
            </div>

        </div>
    </div>
    <div class="contactPage__map" id="map"></div>
</main>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo SCF::get( 'map_key' ); ?>&callback=initMap"></script>
<script>
    const stylesArray = [
        {
            "featureType": "all",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "saturation": 36
                },
                {
                    "color": "#333333"
                },
                {
                    "lightness": 40
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#fefefe"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#fefefe"
                },
                {
                    "lightness": 17
                },
                {
                    "weight": 1.2
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#dedede"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 29
                },
                {
                    "weight": 0.2
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 18
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f2f2f2"
                },
                {
                    "lightness": 19
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#e9e9e9"
                },
                {
                    "lightness": 17
                }
            ]
        }
    ];
    const myMap = document.getElementById("map");

    function initMap() {
        const center = new google.maps.LatLng(<?php echo SCF::get( 'LatLng' ); ?>);

        // Styles a map in night mode.
        const map = new google.maps.Map(myMap, {
            center: center,
            zoom: <?php echo SCF::get( 'map_zoom' ); ?>,
            styles: stylesArray,
        });

        addMarker(center, map);
    }

    // Adds a marker to the map.
    function addMarker(location, map) {

        new google.maps.Marker({
            position: location,
            map,
            title: "GlobalEcoBioScence",
            icon: "<?php echo wp_get_attachment_url(SCF::get( 'map_marker' )) ?>",
        });

    }
</script>
<?php
get_footer();
