# Php-template-parse
Simple php template parse


# PHP-CRUD-API

Single file PHP script that adds a REST API to a MySQL/MariaDB, PostgreSQL, SQL Server or SQLite database. 

NB: This is the [TreeQL](https://treeql.org) reference implementation in PHP.

Related projects:

#### Update

To update a record in this table the request can be written in URL format as:

    PUT /records/posts/1

Where "1" is the value of the primary key of the record that you want to update. Send as a body:

    {
        "title": "Adjusted title!"
    }

This adjusts the title of the post. And the return value is the number of rows that are set:

    1

#### Delete

If you want to delete a record from this table the request can be written in URL format as:

    DELETE /records/posts/1

And it will return the number of deleted rows:

    1

#### List

To list records from this table the request can be written in URL format as:

    GET /records/posts

It will return:

    {
        "records":[
            {
                "id": 1,
                "title": "Hello world!",
                "content": "Welcome to the first post.",
                "created": "2018-03-05T20:12:56Z"
            }
        ]
    }

On list operations you may apply filters and joins.

### Filters

Filters provide search functionality, on list calls, using the "filter" parameter. You need to specify the column
name, a comma, the match type, another commma and the value you want to filter on. These are supported match types:

  - "cs": contain string (string contains value)
  - "sw": start with (string starts with value)
  - "ew": end with (string end with value)
  - "eq": equal (string or number matches exactly)
  - "lt": lower than (number is lower than value)
  - "le": lower or equal (number is lower than or equal to value)
  - "ge": greater or equal (number is higher than or equal to value)
  - "gt": greater than (number is higher than value)
  - "bt": between (number is between two comma separated values)
  - "in": in (number or string is in comma separated list of values)
  - "is": is null (field contains "NULL" value)

You can negate all filters by prepending a "n" character, so that "eq" becomes "neq". 
Examples of filter usage are:

    GET /records/categories?filter=name,eq,Internet
    GET /records/categories?filter=name,sw,Inter
    GET /records/categories?filter=id,le,1
    GET /records/categories?filter=id,ngt,1
    GET /records/categories?filter=id,bt,0,1
    GET /records/categories?filter=id,in,0,1

Output:

    {
        "records":[
            {
                "id": 1
                "name": "Internet"
            }
        ]
    }

In the next section we dive deeper into how you can apply multiple filters on a single list call.

### Multiple filters

Filters can be a by applied by repeating the "filter" parameter in the URL. For example the following URL: 

    GET /records/categories?filter=id,gt,1&filter=id,lt,3

will request all categories "where id > 1 and id < 3". If you wanted "where id = 2 or id = 4" you should write:

    GET /records/categories?filter1=id,eq,2&filter2=id,eq,4
    
As you see we added a number to the "filter" parameter to indicate that "OR" instead of "AND" should be applied.
Note that you can also repeat "filter1" and create an "AND" within an "OR". Since you can also go one level deeper
by adding a letter (a-f) you can create almost any reasonably complex condition tree.

NB: You can only filter on the requested table (not on it's included tables) and filters are only applied on list calls.

### Column selection

By default all columns are selected. With the "include" parameter you can select specific columns. 
You may use a dot to separate the table name from the column name. Multiple columns should be comma separated. 
An asterisk ("*") may be used as a wildcard to indicate "all columns". Similar to "include" you may use the "exclude" parameter to remove certain columns:

```
GET /records/categories/1?include=name
GET /records/categories/1?include=categories.name
GET /records/categories/1?exclude=categories.id
```

Output:

```
    {
        "name": "Internet"
    }
```

NB: Columns that are used to include related entities are automatically added and cannot be left out of the output.

### Ordering

With the "order" parameter you can sort. By default the sort is in ascending order, but by specifying "desc" this can be reversed:

```
GET /records/categories?order=name,desc
GET /records/categories?order=id,desc&order=name
```

Output:

```
    {
        "records":[
            {
                "id": 3
                "name": "Web development"
            },
            {
                "id": 1
                "name": "Internet"
            }
        ]
    }
```
