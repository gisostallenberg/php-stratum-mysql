#!/bin/bash

if [[ -L test/psql/oracle ]]; then
  rm test/psql/oracle
fi

if [[ -L test/psql/inet6 ]]; then
  rm test/psql/inet6
fi

mysql -utest -ptest test -e "set SQL_MODE='ORACLE'" 2>&1 > /dev/null
if [[ $? -eq 0 ]]; then
  ln -s ../oracle test/psql/oracle
fi

mysql -utest -ptest test -e "create temporary table IPv6(ip inet6)" 2>&1 > /dev/null
if [[ $? -eq 0 ]]; then
  ln -s ../inet6 test/psql/inet6
fi

