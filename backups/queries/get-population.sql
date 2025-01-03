SELECT 
    population.id AS population_id,
    population.population,
    circular_class_grade.id AS circular_class_grade_id,
    circular_class_grade.gradelevel_id,
    grade_level.shortcode,
    beis_school_year.id AS beis_school_year_id,
    beis_school_year.school_year_id,
    school_year.id AS school_year_id,
    school_year.from AS school_year_from,
    school_year.to AS school_year_to,
    beis.id AS beis_id,
    beis.beis_id AS beis_beis_id,
    station.id AS station_id,
    station_name.id AS station_name_id,
    station_name.station_name
FROM 
    population
INNER JOIN circular_class_grade 
    ON population.circular_class_grade_id = circular_class_grade.id
INNER JOIN grade_level 
    ON circular_class_grade.gradelevel_id = grade_level.id
INNER JOIN beis_school_year 
    ON population.beis_school_year_id = beis_school_year.id
INNER JOIN school_year 
    ON beis_school_year.school_year_id = school_year.id
INNER JOIN beis 
    ON beis_school_year.beis_id = beis.id
INNER JOIN station 
    ON beis.station_id = station.id
INNER JOIN station_name 
    ON station.id = station_name.station_id;