## My firstWebsite

## Project idea

1. user can create a new help ticket
2. admin can reply on help ticket
3. admin can reject or resolve the ticket
4. when admin update on the ticket then user will get one notification via email that ticket status is updated
5. user can give ticket title and description
6. user can upload a document like pdf and image.

## Table structure
1. tickets 
    - title( string ),
    - description( text )
    - status( open {default}, resolved, rejected )
    - attachment( string ) {nullable}
    - user_id {required} filled by laravel
    - status_changed_by_id {nullable}

2. replies 
    - body( text ) {required}
    - user_id, ticket_id
    - ticket_id {required} filled by laravel
