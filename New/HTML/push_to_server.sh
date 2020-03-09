#!/bin/bash

rsync -azPvhe ssh --exclude-from "exclude-list.txt" --delete . ckl41@srcf.net:/home/ckl41/public_html/.
