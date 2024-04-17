@echo off

::::::::::::::  stop
echo Start Sync ...

D:/www/rsync/cwRsync_5.4/rsync.exe -avzP  --port=873 --delete --no-super -og --chown=www:www --password-file=/cygdrive/D/www/rsync/cwRsync_5.4/pass.txt --exclude=logs/* --exclude=.git/ --exclude=.idea/ /cygdrive/D/www/yii2-app-basic-sw/ root@192.168.168.200::basic

echo Success...
:: 延时
choice /t 5 /d y /n >nul
::pause
exit