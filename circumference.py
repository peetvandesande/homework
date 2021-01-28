#!/usr/bin/python3
import math

radius = int(input('What is the radius? '))
circumference = 2 * math.pi * radius
area = math.pi * radius ** 2
# Or go simple
#area = math.pi * radius * radius
print(f'The circumference is: {circumference}')
print(f'The area is: {area}')
