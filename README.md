# pub-sub-http
A publisher subscriber  pattern example using http requests

# API
## Subscriber

| `Endpoint` | `/subscribe/{topic}` |      |
| :---------| :------------ | ----- |
| Request Type |  POST       |    
| Description  | Creates a new subscription, to topic specified in `topic` parameter |
|             |                      |
|  `Field`      | `Limits` |  `Required`    |
| topic    | String | YES         |
| url      | Standard url, unique for every subscription  | YES         |

## Publisher
| `Endpoint` | `publish/{topic}` |      |
| :---------| :------------ | ----- |
| Request Type |  POST       |    
| Description  | Creates a new publication, sending a notification to all suscribers with same topic as the `topic` parameter |
|             |                      |
|  `Field`      | `Limits` |  `Required`    |
| topic    | String | YES         |
| message      | String  | YES         |

## Confirm Publication
| `Endpoint` | `/{endpoint}` |      |
| :---------| :------------ | ----- |
| Request Type |  GET      |    
| Description  | Returns messages published to subscribers using similar endpoint to `endpoint` parameter |
|             |                      |
|  `Field`      | `Limits` |  `Required`    |
| endpoint    | String | YES         |

# Architecture 
Model View Controller(MVC) using Laravel

## Schema
* Subscription Schema

    * ```
        $table->id();
            $table->string('topic');
            $table->string('callback_url')->unique();
            $table->timestamps();
    ```

* Publication Schema
    * ``` 
            $table->id();

            $table->string('topic');

            $table->string('message');

            $table->boolean('message_delivered')->default(false);

            $table->timestamps();
     ```


* PublicationSubscription(Pivotal table) Schema

    * ```
        $table->id();
            $table->string('topic');
            $table->unsignedBigInteger('publication_id');
            $table->unsignedBigInteger('subscription_id');
            $table->string('message');
            $table->boolean('message_received')->default(false);
            $table->timestamps();
    ```

## Publication flow
* Get publication POST `topic` and `message` body
* Save to Publication model
* Broadcast TopicPublished `event`
* Transfer flow to NotifySubscriber `listener`
* search for subscribers with publication topic
* Use many to many relationship between publication and subscription to add both to Pivot table, then update message_delivered column on publication


# Setup
- This is a [Laravel](https://laravel.com/docs/8.x) application, so you need to have [PHP](https://www.apachefriends.org/index.html), [Composer](https://getcomposer.org/doc/00-intro.md) and [MySQL](https://www.apachefriends.org/index.html) installed 
- Clone this repository locally
- Run `composer install` to install app dependencies
- Create a table in your database called `<any-name-you-want>`
- Make a copy of .env.example, save the copy as .env 
- Edit the database section of your newly created .env file to match your database credentials
- Run `php artisan migrate --seed` to migrate and seed required database tables
- Run `php artisan key:generate` to generate a unique key for your apllication
- Run `php artisan serve` and navigate to your browser to test app

- Test seeders using /order1, /order2, order3


