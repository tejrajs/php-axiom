<?php

Log::setConfig();
Log::addLogger(new TextLogger(APPLICATION_PATH . '/ressources/temp/logs/app.log'));