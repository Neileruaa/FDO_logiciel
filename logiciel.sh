#!/bin/bash
cd . && php bin/console server:start && npm run watch & firefox http://127.0.0.1:8000/;
