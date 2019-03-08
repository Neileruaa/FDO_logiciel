#!/bin/bash
cd /home/antoi/PhpstormProjects/FDO_logiciel && 
npm run dev && 
wait
php bin/console server:run &
firefox http://127.0.0.1:8000/;
