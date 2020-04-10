#!/bin/sh

SESSION="supportme-web"
SESSIONEXISTS=$(tmux list-sessions | grep $SESSION)

if [ "$SESSIONEXISTS" = "" ]
then
	tmux new-session -d -s $SESSION

	tmux rename-window -t $SESSION:1 'edit'
	tmux send-keys -t 'edit' 'nvim' C-m

	tmux new-window -t $SESSION:2 -n 'php'
	tmux send-keys -t 'php' "php artisan serve --host dione.fritz.box" C-m

	tmux new-window -t $SESSION:3 -n 'npm'
	tmux send-keys -t 'npm' 'npm run watch-poll' "" C-m

	tmux new-window -t $SESSION:4 -n 'tinker'
	tmux send-keys -t 'tinker' "php artisan tinker" C-m

	tmux new-window -t $SESSION:5 -n 'shell'
	tmux send-keys -t 'shell' "bash" C-m
fi

tmux attach-session -t $SESSION:1
