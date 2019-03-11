eos/arango-db-3-connector-bundle
=================================
Symfony integration for [eos/arango-db-3-connector](https://github.com/eosnewmedia/ArangoDB-3-Connector).

# Installation

```bash
composer req eos/arango-db-3-connector-bundle
```

# Configuration

```yaml
eos_arango_db_connector:
    servers: ['http://127.0.0.1:8529']
    user: 'root'
    password: null
    database: 'your_database'
    collections:
        your_collection:
            type: 'document' # document|edge
            wait_for_sync: false # false is the default
            indices:
                your_index:
                    type: 'hash'
                    fields: ['id']
                    options:
                        unique: true
```

# Commands
These commands are available:

- `eos:arango-db:database:create`
- `eos:arango-db:database:remove`
- `eos:arango-db:collections:create`
- `eos:arango-db:collections:remove`

# Service

The database is available for autowiring with the service id `Eos\ArangoDBConnector\ArangoDBInterface`.
