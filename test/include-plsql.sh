#!/bin/sh

if [[ -L test/psql/oracle ]]; then
  rm test/psql/oracle
fi

mysql -utest -ptest test -e "set SQL_MODE='ORACLE'" 2>&1 > /dev/null
if [[ $? -eq 0 ]]; then
  ln -s ../oracle test/psql/oracle
fi
