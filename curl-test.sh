#!/bin/bash
curl -X POST -H "Authorization: key=AAAAmzQpmKg:APA91bH_eKAvTdIfojlLpsLIvRdaXQVtlFuWR5lXVc0lfL57n1pzinP44l9u3F4jsh65L53zvxWhVXN9hhhVXS4BfYnykfsOdYowTT5kJhZNZkP2gd9nDuuFM0s6fzRzO61qi5nmtJ8-" -H "Content-Type: application/json" \
   -d '{
  "data": {
    "notification": {
        "title": "FCM Message",
        "body": "This is an FCM Message",
        "icon": "/itwonders-web-logo.png",
    }
  },
  "to": "dU4bYcyZoZc:APA91bF6PT5yBPDNm6fgSV3Z-AxHslo0DadThOktFuSEi09SnYBtDANmxqcnW60E91NqwL0jML3XqBw9_7wacMVO0bTnbs9V-7eFogg4vSYmUPzklCH8Dptndmf3niI_meKsic4RlCOK"
}' https://fcm.googleapis.com/fcm/send
