<?php
        if (is_dynamic_sidebar("main-sidebar")) {
                dynamic_sidebar( "main-sidebar" );
        } else {
                _e('This is widget area. Go to Appearance -> Widgets to add some widgets.', 'tungxen');
        }
?>