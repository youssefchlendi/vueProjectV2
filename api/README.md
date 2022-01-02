
## API Reference

#### Get items {All,By id,By page,By search}

```http
  GET /api/{class,examen,etudient,enseignant,matiere}/read.php
  GET /api/{class,examen,etudient,enseignant,matiere}/read_one.php?id="CLASSIDHERE"
  GET /api/{class,examen,etudient,enseignant,matiere}/read_paging.php
  GET /api/{class,examen,etudient,enseignant,matiere}/search.php?s="SEARCHSTRINGHERE"
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `string` | **Required**. For read by id (read_one) |
| `s` | `string` | **Required**. For search by string (search) |

# class
### Create
```http
  POST /api/class/create.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `intitule`      | `string` | **Required**. Class name |
| `abr`      | `string` | **Required**. Class Abbreveation |

### Delete
```http
  POST /api/class/delete.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Class ID |

### Update
```http
  POST /api/class/update.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Class ID |
| `intitule`      | `string` |  Class name |
| `abr`      | `string` |  Class Abbreveation |



# enseignant
### Create
```http
  POST /api/enseignant/create.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `nom`      | `string` | **Required**. professor lastname |
| `prenom`      | `string` | **Required**. professor first |
| `CIN`      | `int` | **Required**. professor CIN |

### Delete
```http
  POST /api/enseignant/delete.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. professor ID |

### Update
```http
  POST /api/enseignant/update.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Class ID |
| `nom`      | `string` |  professor lastname |
| `prenom`      | `string` |  professor first |
| `CIN`      | `int` |  professor CIN |

# Etudient
### Create
```http
  POST /api/etudient/create.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `nom`      | `string` | **Required**. student lastname |
| `prenom`      | `string` | **Required**. student first |
| `CIN`      | `int` | **Required**. student CIN |
| `class`      | `int` |  student classId |
| `numIns`      | `int` | **Required**. student inscription number |

### Delete
```http
  POST /api/etudient/delete.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. student ID |

### Update
```http
  POST /api/etudient/update.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Class ID |
| `nom`      | `string` |  student lastname |
| `prenom`      | `string` |  student first |
| `CIN`      | `int` |  student CIN |
| `class`      | `int` |  student classId |
| `numIns`      | `int` |  student inscription number |

# examen
### Create
```http
  POST /api/examen/create.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `intitule`      | `string` | **Required**. exam title |
| `coefficient`      | `float` | **Required**. exam coefficient |
| `idMatiere`      | `int` | **Required**. module id |
| `idProf`      | `int` |  professor id |
| `idEtudient`      | `int` | student id |
| `note`      | `float` | score |

### Delete
```http
  POST /api/examen/delete.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. exam ID |

### Update
```http
  POST /api/examen/update.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. exam ID |
| `intitule`      | `string` |  exam title |
| `coefficient`      | `float` |  exam coefficient |
| `idMatiere`      | `int` |  module id |
| `idProf`      | `int` |  professor id |
| `idEtudient`      | `int` | student id |
| `note`      | `float` | score |


# module
### Create
```http
  POST /api/matiere/create.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `intitule`      | `string` | **Required**. module title |
| `coefficient`      | `float` | **Required**. module coefficient |
| `idProf`      | `int` |  professor id |

### Delete
```http
  POST /api/matiere/delete.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. module ID |

### Update
```http
  POST /api/matiere/update.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. module ID |
| `intitule`      | `string` |  module title |
| `coefficient`      | `float` |  module coefficient |
| `idProf`      | `int` |  professor id |


